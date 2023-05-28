// Cached core static resources 
self.addEventListener("install",e=>{
    e.waitUntil(
      caches.open("static").then(cache=>{
        return cache.addAll(["./login.php",'assets/pwa-logos/logo_192.png']);
      })
    );
  });
  
  // Fatch resources
  self.addEventListener("fetch",e=>{
    e.respondWith(
      caches.match(e.request).then(response=>{
        return response||fetch(e.request);
      })
    );
  });