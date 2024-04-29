import React, { useEffect } from "react";
import { Link } from "react-router-dom";
import { useTranslation } from "react-i18next";

function EditorSwitcher() {
  const { t } = useTranslation();

  useEffect(() => {}, []);

  return (
    <div className="flex flex-col justify-center items-center gap-2 my-20">
      <h1
        style={{
          fontSize: "35px",
          color: "rgb(170 191 5)",
          fontWeight: "bold",
        }}
      >
        {t("Choose Site Editor")}
      </h1>
      <Link to="/site-editor/restaurants">
        <button className="bg-[var(--primary)] rounded-md p-2">
          {t("Restaurant Editor")}
        </button>
      </Link>
      {/*<Link to='/site-editor/customers'>*/}
      {/*   <button className='bg-[var(--primary)] rounded-md p-2'>*/}
      {/*       {t("Customer Editor")}*/}
      {/*   </button>*/}
      {/*</Link>*/}
    </div>
  );
}

export default EditorSwitcher;
