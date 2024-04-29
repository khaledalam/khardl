import React from "react";
import { useTranslation } from "react-i18next";

function Copyright() {
  const { t } = useTranslation();
  return (
    <footer className="bg-[var(--primary)] flex items-center justify-center py-4 rounded-b-[30px] border-t-[0.5px] border-t-black">
      <p className="max-[450px]:text-sm max-[450px]:mx-2">
        © {t("All rights reserved")} -{" "}
        <a href={"https://stats.uptimerobot.com/xjL9numDqg"} target={"_blank"}>
          🟢
        </a>
      </p>
    </footer>
  );
}

export default Copyright;
