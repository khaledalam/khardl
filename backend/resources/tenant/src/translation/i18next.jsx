import i18n from "i18next";
import { initReactI18next } from "react-i18next";
import LanguageDetector from "i18next-browser-languagedetector";
import translationEN from "./lang/en.json"
import translationAR from "./lang/ar.json"

const resources = {
  en: {
    translation: translationEN,
  },
  ar: {
    translation: translationAR,
  },
};

i18n
  .use(LanguageDetector)
  .use(initReactI18next)
  .init({
    resources,
    lng: localStorage.getItem("i18nextLng") || "ar",
    interpolation: {
      escapeValue: false,
    },
    react: {
      useSuspend: false,
    },
  });

export default i18n;
