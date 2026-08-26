// AUTO-GENERATED — do not edit CACHE manually, run build/build.php instead
const CACHE = 'khmer-dc5db06e';

self.addEventListener('install', e => {
  e.waitUntil(self.skipWaiting());
});

self.addEventListener('activate', e => {
  e.waitUntil(
    caches.keys()
      .then(keys => Promise.all(keys.filter(k => k !== CACHE).map(k => caches.delete(k))))
      .then(() => self.clients.claim())
  );
});

// Просто пропускаем все запросы через сеть, не трогаем кеш
self.addEventListener('fetch', e => {
  e.respondWith(fetch(e.request));
});
