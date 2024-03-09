import React, { useState } from "react";
import Card from "./Card";
import { useTranslation } from "react-i18next";

function MenuItems({ items }) {
    const { t } = useTranslation();

    const [selectedCategory, setSelectedCategory] = useState(null);

    return (
        <div
            className={`text-xl mt-4 bg-[#ffffff15] w-[100%] ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? "rounded-md " : ""}`}
        >
            <div
                className={`grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 xs:grid-cols-1 gap-6
      ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? "rounded-md p-2" : "p-4"}`}
            >
                {items.map((item, index) => (
                    <Card
                        key={index}
                        id={item.id}
                        title={item.title}
                        price={item.price}
                        name={item.name}
                        description={item.description || ""}
                        calories={item.calories}
                        image={item.photo}
                        checkbox_required={item.checkbox_required}
                        checkbox_input_titles={item.checkbox_input_titles}
                        checkbox_input_names={item.checkbox_input_names}
                        checkbox_input_prices={item.checkbox_input_prices}
                        selection_required={item.selection_required}
                        selection_input_titles={item.selection_input_titles}
                        selection_input_names={item.selection_input_names}
                        selection_input_prices={item.selection_input_prices}
                        dropdown_required={item.dropdown_required}
                        dropdown_input_titles={item.dropdown_input_titles}
                        dropdown_input_names={item.dropdown_input_names}
                    />
                ))}
            </div>
        </div>
    );
}

export default MenuItems;
