import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect'; // <-- PENTING: Import plugin intersect

// Daftarkan plugin intersect ke Alpine.js
Alpine.plugin(intersect); // <-- PENTING: Aktivasi plugin

window.Alpine = Alpine;

Alpine.start();