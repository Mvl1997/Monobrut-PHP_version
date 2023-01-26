export default {
  css: {
    devSourcemap: true,
  },
  build: {
    //de volgende instelling genereert een manifest bestand waar alle gebuilde files in zitten.
    //we moeten tenslotte hun unieke filename kennen om ze te kunnen koppelen met de php file.
    //de reden dat de gegenereerde files telkens andere filenames hebben geeft 1 groot voordeel.
    //een bestand met een nieuwe naam wordt altijd gedownload en is dus nooit gecached.
    manifest: true,
    //de watch instelling zorgt ervoor dat de build altijd opnieuw wordt uitgevoerd als de scss od js file wijzigt
    watch: true,
    //onderstaande stelt de js file in als entrypoint voor vite ipv. index.html
    rollupOptions: {
      input: "/js/index.js",
    },
  },
};
