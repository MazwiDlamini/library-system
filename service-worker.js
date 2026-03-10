const CACHE_NAME = "library-system-v1";

const urlsToCache = [
"/",
"/client/index.php",
"/client/dashboard.php",
"/admin/dashboard.php",
"/assets/"
];

self.addEventListener("install", event => {
event.waitUntil(
caches.open(CACHE_NAME)
.then(cache => {
return cache.addAll(urlsToCache);
})
);
});

self.addEventListener("fetch", event => {
event.respondWith(
caches.match(event.request)
.then(response => {
return response || fetch(event.request);
})
);
});