import { useTranslation } from "react-i18next";


export const RightSideBar = () => {
    const { t } = useTranslation();
    return (
        <div className="px-[16px]">
            <h2 className="font-medium text-sm mt-[24px] mb-4">{t("Designs")}</h2>
        </div>
    );
};