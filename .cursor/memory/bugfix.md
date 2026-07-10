# Bugfix


## 2026-07-09 23:58 UTC

Галерея clinic-gallery на /about/: исходники с iPhone были HEIF (.png) и HEVC (.mov) — браузеры не воспроизводят. Конвертировано в webp + mp4 H.264, mov/png удалены, PHP принимает только webp/jpg/png/mp4/webm.

## 2026-07-10 00:47 UTC

Hero белый экран: opacity is-ready перекрывался CSS — исправлено в site-updates.css

## 2026-07-10 01:25 UTC

Hero-видео на десктопе не грузилось — preload постера, is-ready класс, HD source
