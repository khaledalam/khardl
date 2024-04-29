import React from "react";
import { useSelector } from "react-redux";

const CartColumn = ({ children, headerTitle, isRequired }) => {
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);
  return (
    <div className="">
      <div
        style={{
          backgroundColor: restuarantStyle.categoryDetail_cart_color,
        }}
        className={`h-[43px] ${
          restuarantStyle.categoryDetail_cart_color ? "" : "bg-[var(--primary)]"
        }  border rounded-tr-lg rounded-tl-lg border-[var(--primary)] w-full flex items-center justify-center`}
      >
        <h3 className="relative">
          {headerTitle}
          {isRequired && (
            <span className="absolute top-0 right-[-0.7rem] font-bold text-xl text-red-500">
              *
            </span>
          )}
        </h3>
      </div>
      {children}
    </div>
  );
};

export default CartColumn;
