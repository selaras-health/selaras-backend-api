<?php

namespace App\Repositories;

use App\Models\DailyMealGuide;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DailyMealGuideRepository
{
  /**
   * Mengambil SEMUA riwayat panduan menu, di-cache, tanpa paginasi.
   * * @return \Illuminate\Database\Eloquent\Collection
   */
  public function listForUser(User $user): Collection
  {
    $cacheKey = "user:{$user->id}:daily_guides:all";

    $cachedResultAsArray = Cache::rememberForever($cacheKey, function () use ($user) {
      Log::info("CACHE MISS: Mengambil data riwayat DailyMealGuide dari DB untuk user ID: {$user->id}");
      return $user->profile
        ->dailyMealGuides()
        ->toBase()          // <-- Kunci #1: Ubah ke query builder dasar
        ->latest('guide_date')
        ->latest('id')
        ->get()
        ->map(fn($item) => (array)$item) // Ubah tiap stdClass jadi array
        ->all();             // Dapatkan array biasa sebagai hasil akhir
    });

    // Data di cache sekarang mentah (JSON masih string).
    // Proses rehydration ini sekarang 100% aman.
    $items = collect($cachedResultAsArray)->map(function ($itemData) {
      $model = new DailyMealGuide();
      $model->setRawAttributes($itemData, true);
      return $model;
    });

    return new Collection($items);
  }

  /**
   * Menyimpan sebuah panduan menu yang baru di-generate dan menghapus cache riwayat.
   */
  public function saveGuide(User $user, array $context, array $guideData): \App\Models\DailyMealGuide
  {
    $guide = $user->profile->dailyMealGuides()->create([
      'guide_date' => now()->toDateString(),
      'generation_context' => $context,
      'guide_data' => $guideData,
    ]);

    // [PENTING] Naikkan versi cache untuk membuat semua cache lama menjadi usang.
    $this->bustHistoryCache($user);

    return $guide;
  }

  /**
   * Mengambil riwayat pilihan menu terakhir untuk 'pembelajaran' AI.
   * Di sini kita asumsikan ada interaksi 'like' atau 'choose' dari frontend nanti.
   */
  public function getLatestChosenGuides(User $user, int $limit = 5): Collection
  {
    // Untuk sekarang, kita ambil yang terakhir dibuat sebagai simulasi
    return $user->profile->dailyMealGuides()->latest()->take($limit)->get();
  }

  /**
   * Helper untuk menghapus semua cache yang berhubungan dengan riwayat panduan menu pengguna ini.
   * Menggunakan tag agar lebih efisien.
   */
  public function forgetHistoryCache(User $user): void
  {
    $cacheTags = ["user:{$user->id}:daily_guides"];
    Cache::tags($cacheTags)->flush();
    Log::info("CACHE FLUSHED: Cache riwayat DailyMealGuide dihapus untuk user ID: {$user->id}");
  }

  private function getVersionCacheKey(User $user): string
  {
    return "user:{$user->id}:daily_guides:version";
  }

  /**
   * [PENDEKATAN DEBUGGING] Menghapus cache secara langsung dengan logging.
   */
  public function bustHistoryCache(User $user): void
  {
    $cacheKey = "user:{$user->id}:daily_guides:all";

    // LOG 3: Kita catat bahwa kita akan menghapus kunci ini
    Cache::forget($cacheKey);
    Log::info("CACHE FORGOTTEN: Cache riwayat DailyMealGuide dihapus untuk key: {$cacheKey}");
  }
}
