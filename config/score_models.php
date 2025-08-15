<?php

/**
 * File Konfigurasi untuk Model Risiko Kardiovaskular SCORE2.
 *
 * Berisi semua koefisien, baseline survival, dan skala kalibrasi
 * yang diambil langsung dari publikasi ilmiah SCORE2, SCORE2-OP, dan SCORE2-Diabetes.
 * Memisahkan data ini dari logika bisnis membuat aplikasi lebih mudah
 * untuk dipelihara dan diperbarui di masa depan.
 */

return [
  'score2' => [
    'coefficients' => [
      'male' => [
        'age' => 0.3742,
        'smoking' => 0.6012,
        'sbp' => 0.2777,
        'tchol' => 0.1458,
        'hdl' => -0.2698,
        'smoking_age' => -0.0755,
        'sbp_age' => -0.0255,
        'tchol_age' => -0.0281,
        'hdl_age' => 0.0426,
      ],
      'female' => [
        'age' => 0.4648,
        'smoking' => 0.7744,
        'sbp' => 0.3131,
        'tchol' => 0.1002,
        'hdl' => -0.2606,
        'smoking_age' => -0.1088,
        'sbp_age' => -0.0277,
        'tchol_age' => -0.0226,
        'hdl_age' => 0.0613,
      ],
    ],
    'baseline_survival' => [
      'male' => 0.9605,
      'female' => 0.9776,
    ],
    'calibration_scales' => [
      'low' => ['male' => [-0.5699, 0.7476], 'female' => [-0.7380, 0.7019]],
      'moderate' => ['male' => [-0.1565, 0.8009], 'female' => [-0.3143, 0.7701]],
      'high' => ['male' => [0.3207, 0.9360], 'female' => [0.5710, 0.9369]],
      'very_high' => ['male' => [0.5836, 0.8294], 'female' => [0.9412, 0.8329]],
    ],
  ],

  'score2_op' => [
    'coefficients' => [
      'male' => [
        'age' => 0.0634,
        'diabetes' => 0.4245,
        'smoking' => 0.3524,
        'sbp' => 0.0094,
        'tchol' => 0.0850,
        'hdl' => -0.3564,
        'diabetes_age' => -0.0174,
        'smoking_age' => -0.0247,
        'sbp_age' => -0.0005,
        'tchol_age' => 0.0073,
        'hdl_age' => 0.0091,
      ],
      'female' => [
        'age' => 0.0789,
        'diabetes' => 0.6010,
        'smoking' => 0.4921,
        'sbp' => 0.0102,
        'tchol' => 0.0605,
        'hdl' => -0.3040,
        'diabetes_age' => -0.0107,
        'smoking_age' => -0.0255,
        'sbp_age' => -0.0004,
        'tchol_age' => -0.0009,
        'hdl_age' => 0.0154,
      ],
    ],
    'baseline_survival' => [
      'male' => 0.7576,
      'female' => 0.8082,
    ],
    'mean_linear_predictor' => [
      'male' => 0.0929,
      'female' => 0.2290,
    ],
    'calibration_scales' => [
      'low' => ['male' => [-0.34, 1.19], 'female' => [-0.52, 1.01]],
      'moderate' => ['male' => [0.01, 1.25], 'female' => [-0.10, 1.10]],
      'high' => ['male' => [0.08, 1.15], 'female' => [0.38, 1.09]],
      'very_high' => ['male' => [0.05, 0.70], 'female' => [0.38, 0.69]],
    ],
  ],

  'score2_diabetes' => [
    'coefficients' => [
      'male' => [
        'age' => 0.5368,
        'smoking' => 0.4774,
        'sbp' => 0.1322,
        'diabetes' => 0.6457,
        'tchol' => 0.1102,
        'hdl' => -0.1087,
        'smoking_age' => -0.0672,
        'sbp_age' => -0.0268,
        'diabetes_age' => -0.0983,
        'tchol_age' => -0.0181,
        'hdl_age' => 0.0095,
        'age_at_diabetes_diagnosis' => -0.0998,
        'hba1c' => 0.0955,
        'egfr' => -0.0591,
        'egfr2' => 0.0058,
        'hba1c_age' => -0.0134,
        'egfr_age' => 0.0115
      ],
      'female' => [
        'age' => 0.6624,
        'smoking' => 0.6139,
        'sbp' => 0.1421,
        'diabetes' => 0.8096,
        'tchol' => 0.1127,
        'hdl' => -0.1568,
        'smoking_age' => -0.1122,
        'sbp_age' => -0.0167,
        'diabetes_age' => -0.1272,
        'tchol_age' => -0.0200,
        'hdl_age' => 0.0186,
        'age_at_diabetes_diagnosis' => -0.1180,
        'hba1c' => 0.1173,
        'egfr' => -0.0640,
        'egfr2' => 0.0062,
        'hba1c_age' => -0.0196,
        'egfr_age' => 0.0169
      ],
    ],
    'baseline_survival' => [
      'male' => 0.9605,
      'female' => 0.9776,
    ],
    'calibration_scales' => [ // Sama dengan SCORE2
      'low' => ['male' => [-0.5699, 0.7476], 'female' => [-0.7380, 0.7019]],
      'moderate' => ['male' => [-0.1565, 0.8009], 'female' => [-0.3143, 0.7701]],
      'high' => ['male' => [0.3207, 0.9360], 'female' => [0.5710, 0.9369]],
      'very_high' => ['male' => [0.5836, 0.8294], 'female' => [0.9412, 0.8329]],
    ],
  ]
];
