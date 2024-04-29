import { useTranslation } from "react-i18next";

const Footer = ({ restaurantStyle }) => {
  const { t } = useTranslation();

  const {
    footer_alignment,
    footer_text_fontFamily,
    footer_text_fontWeight,
    footer_text_fontSize,
    footer_text_color,
  } = restaurantStyle;

  return (
    <div
      style={{ backgroundColor: "white" }}
      className={`w-full min-h-[30px]  rounded-xl flex  ${
        footer_alignment === "center"
          ? "items-center justify-center"
          : footer_alignment === "left"
            ? "items-center justify-start"
            : footer_alignment === "right"
              ? "items-center justify-end"
              : ""
      }`}
    >
      <h3
        style={{ color: footer_text_color }}
        className={`${
          footer_text_fontFamily
            ? `font-['${footer_text_fontFamily}']`
            : "font-['Plus Jakarta Sans']"
        }
            ${
              footer_text_fontSize
                ? `text-[${footer_text_fontSize}px]`
                : "text-[10px]"
            }
            ${
              footer_text_fontWeight
                ? `font-${footer_text_fontWeight}`
                : "font-normal"
            }
             leading-3 tracking-tight relative`}
      >
        <span>{t("Powered by")}</span>
        <a
          href="https://khardl.com/"
          className="text-[#7D0A0A] font-medium hover:cursor-pointer"
        >
          {" "}
          {t("Khardl")}
        </a>
      </h3>
    </div>
  );
};

export default Footer;
