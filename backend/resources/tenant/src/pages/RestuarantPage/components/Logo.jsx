import EmptyBackground60 from "../../../assets/emptyBackground60.png";
import UploadIcon from "../../../assets/uploadIcon.png";
import { useTranslation } from "react-i18next";

const Logo = ({ restaurantStyle }) => {
  const { t } = useTranslation();
  const {
    logo_alignment,
    logo_border_radius,
    logo_border_color,
    logo,
    logo_shape,
  } = restaurantStyle;

  return (
    <div
      className={`w-full h-[80px] bg-white rounded-xl flex ${
        logo_alignment === "center"
          ? "items-center justify-center"
          : logo_alignment === "left"
            ? "items-center justify-start"
            : logo_alignment === "right"
              ? "items-center justify-end"
              : ""
      }`}
    >
      <div
        style={{
          borderRadius: logo_border_radius
            ? logo_border_radius + "%"
            : logo_shape === "sharp"
              ? 0
              : 12,
          border: `1px solid ${logo_border_color}`,
          backgroundImage: `url(${logo ? logo : EmptyBackground60})`,
          backgroundRepeat: "no-repeat",
          backgroundSize: "cover",
        }}
        className="w-[60px] h-[60px] flex flex-col items-center pt-[17px] pb-[7px] relative"
      >
        <span
          className={`uppercase text-[12px] leading-[16px] font-semibold text-black/[.54] mb-[3px] ${
            logo && "hidden"
          }`}
        >
          {t("Logo")}
        </span>
        <img
          src={UploadIcon}
          alt={""}
          style={{
            borderRadius: logo_shape === "sharp" ? 0 : 12,
          }}
          className={`w-[18px] h-[18px] object-cover ${logo && "hidden"}`}
        />
      </div>
    </div>
  );
};

export default Logo;
