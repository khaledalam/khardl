import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { globalColor, globalShape } from '../../../../redux/editor/buttonSlice';
import DetailesItem from './DetailesItem';
import { useTranslation } from "react-i18next";
import { addItemToCart } from '../../../../redux/editor/cartSlice';

function Card(props) {
  const shapeImageShape = useSelector(state => state.shapeImage.shapeImageShape);
  const GlobalColor = useSelector(globalColor);
  const GlobalShape = useSelector(globalShape);
  const selectedAlignText = useSelector((state) => state.alignText.selectedAlignText);
  const divWidth = useSelector((state) => state.divWidth.value);

  const [showDetailesItem, setShowDetailesItem] = useState(false);
  function showMeDetailesItem() {
    if (!showDetailesItem) {
      setShowDetailesItem(true);
    } else {
      setShowDetailesItem(false);
    }
  }
  const { t } = useTranslation();
  const dispatch = useDispatch();

  const handleAddToCart = () => {
    dispatch(addItemToCart("props.title"));
  };
  
  return (
    <>
      <div className={`text-[18px]} ${divWidth <= 1200 ? "w-[250px]":""} `}>
        <div 
        style={{ borderRadius: GlobalShape }}
        className="col-span-4 flex flex-col cursor-pointer  shadow-md bg-[var(--secondary)] transition-transform transform hover:-translate-y-2">
          <button className="" onClick={showMeDetailesItem}>
          <div className='p-3 pb-0'>
            <div className="w-full h-[150px] bg-center bg-cover"
              style={shapeImageShape === "14px" ? { padding: "5px", borderRadius: `${GlobalShape} ${GlobalShape} ${shapeImageShape} ${shapeImageShape}`, backgroundImage: `url(${props.image})` } : { borderRadius: shapeImageShape, backgroundImage: `url(${props.image})` }}
            >
            </div>
            </div>
            <h2 className="my-3 px-3 text-[15px] font-bold"
              style={{
                display: '-webkit-box',
                WebkitBoxOrient: 'vertical',
                WebkitLineClamp: 1,
                overflow: 'hidden',
                textOverflow: 'ellipsis',
                lineHeight: '1.2em',
                userSelect: 'none',
                maxHeight: '1.2em',
                textAlign: selectedAlignText
              }}
            >{props.title}</h2>
            <h2 className="my-3 px-3 text-[14px] text-start"
              style={{
                display: '-webkit-box',
                WebkitBoxOrient: 'vertical',
                WebkitLineClamp: 1,
                overflow: 'hidden',
                textOverflow: 'ellipsis',
                lineHeight: '1.2em',
                userSelect: 'none',
                maxHeight: '1.2em',
                textAlign: selectedAlignText
              }}
            >{props.desciption}</h2>
            <div className="flex justify-between items-center px-4 my-4">
              <span className="text-[14px] font-semibold">{props.calories} سعرة</span>
              <span className="text-[14px] text-[#5e5e5e]">{props.price} ر.س</span>
            </div>
          </button>
          <button className="text-center bg-[var(--primary)] py-1 text-black font-bold"
            style={{ borderRadius: `0 0 ${GlobalShape} ${GlobalShape}`, backgroundColor: GlobalColor }}
            onClick={handleAddToCart}
          > {t("add to cart")}</button>
        </div>
      </div>
      {showDetailesItem ? (
        <DetailesItem
          onClose={showMeDetailesItem}
          onRequest={showMeDetailesItem}
          title={props.title}
          desciption={props.desciption}
          image={props.image}
          calories={props.calories}
          price={props.price}
          selection_input_titles={props.selection_input_titles}
          selection_input_names={props.selection_input_names}
          selection_input_prices={props.selection_input_prices}
          checkbox_required={props.checkbox_required}
          checkbox_input_titles={props.checkbox_input_titles}
          checkbox_input_names={props.checkbox_input_names}
          checkbox_input_prices={props.checkbox_input_prices}
          dropdown_input_names={props.dropdown_input_names}
        />
      ) : null}
      {showDetailesItem ? showMeDetailesItem : null}
    </>
  )
}

export default Card
