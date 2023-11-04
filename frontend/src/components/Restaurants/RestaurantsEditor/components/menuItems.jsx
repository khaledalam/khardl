import React from 'react'
import Card from './Card';
import { useSelector } from 'react-redux';
import { getSelectedCategory } from '../../../../redux/editor/categorySlice';
import { useTranslation } from "react-i18next";
import { items } from '../../../../data/data';

function MenuItems({category_id, branch_id}) {
  const { t } = useTranslation();
  const selectedCategory = useSelector(getSelectedCategory);
  const divWidth = useSelector((state) => state.divWidth.value);

  const filteredItems = items.filter(item => (item.category_id === category_id && item.branch_id === branch_id ) );

  return (
    <div className={`text-xl mt-4 bg-[#ffffff15] ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? 'rounded-md ' : ''}`}>
      <div className={`flex justify-start flex-wrap items-start gap-4 w-[100%]
      ${divWidth <= 744 ? "justify-center":""}
      ${selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}` ? 'rounded-md p-2' : 'p-4'}`}>
        {filteredItems.map((item, index) => (
          <Card
            key={index}
            id={item.id}
            title={item.title}
            price={item.price}
            desciption={item.desciption}
            calories={item.calories}
            image={item.image}
            selection_input_names={item.selection_input_names}
            selection_input_prices={item.selection_input_prices}
            checkbox_required={item.checkbox_required}
            checkbox_input_titles={item.checkbox_input_titles}
            checkbox_input_names={item.checkbox_input_names}
            checkbox_input_prices={item.checkbox_input_prices}
            dropdown_input_names={item.dropdown_input_names}
            selection_input_titles={item.selection_input_titles}
          />
        ))
        }
      </div>
    </div>
  )
}

export default MenuItems;
