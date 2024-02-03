import React, { Fragment, useState } from "react";
import ProductItem from "../../EditorsPage/Restuarants/components/ProductItem";
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem";
import { useDispatch, useSelector } from "react-redux";
import { selectedCategoryAPI } from "../../../redux/NewEditor/categoryAPISlice";
import { useTranslation } from "react-i18next";

const ProductSection = ({ categories, isMobile }) => {
  const dispatch = useDispatch();
  const { t } = useTranslation();
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category
  );
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);

  const filterCategory =
    categories && categories.length > 0
      ? categories?.filter((category) => category.id === selectedCategory.id)
      : [{ name: "", items: [] }];

  return (
    <div>
      {(restaurantStyle?.category_alignment === t("Center") ||
        restaurantStyle?.category_alignment === "center" ||
        isMobile) && (
          <Fragment>
            <div
              className="w-full"
              style={{
                backgroundColor: restaurantStyle.product_background_color,
              }}
            >
              <div className="w-5/6 laptopXL:w-[75%] mx-auto py-4">
                {filterCategory && filterCategory.length > 0 ? (
                  filterCategory.map((category, indx) => (
                    <div className="my-4" key={indx}>
                      <h3 className="font-semibold text-[1.5rem] relative">
                        <span className="custom-underline">{category?.name}</span>
                      </h3>
                      <div className="w-[95%] mt-10 ml-auto grid grid-col-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-6 py-10">
                        {category?.items
                          ?.filter((item) => item.availability === 1)
                          .map((product, i) => (
                            <span key={i}>
                              <ProductItem
                                key={product.id}
                                valuekey={product.id}
                                id={product.id}
                                name={product.description}
                                imgSrc={product.photo}
                                amount={product.price}
                                caloryInfo={product.calories}
                                checkbox_required={
                                  product?.checkbox_required ?? ["true", "false"]
                                }
                                checkbox_input_titles={
                                  product?.checkbox_input_titles ?? [[]]
                                }
                                checkbox_input_names={
                                  product?.checkbox_input_names ?? [[]]
                                }
                                checkbox_input_prices={
                                  product?.checkbox_input_prices ?? [[]]
                                }
                                selection_required={
                                  product?.selection_required ?? ["true", "false"]
                                }
                                selection_input_titles={
                                  product?.selection_input_titles ?? [[]]
                                }
                                selection_input_names={
                                  product?.selection_input_names ?? [[]]
                                }
                                selection_input_prices={
                                  product?.selection_input_prices ?? [[]]
                                }
                                dropdown_required={
                                  product?.dropdown_required ?? ["true", "false"]
                                }
                                dropdown_input_titles={
                                  product?.dropdown_input_titles ?? [[]]
                                }
                                dropdown_input_names={
                                  product?.dropdown_input_names ?? [[]]
                                }
                                cartBgcolor={
                                  restaurantStyle?.categoryDetail_cart_color
                                }
                                amountColor={restaurantStyle?.price_color}
                                textColor={restaurantStyle?.text_color}
                                textAlign={restaurantStyle?.text_alignment}
                                fontSize={restaurantStyle?.text_fontSize}
                                shape={restaurantStyle?.categoryDetail_shape}
                              />
                            </span>
                          ))}
                      </div>
                    </div>
                  ))
                ) : (
                  <div className="w-full h-full items-center justify-center">
                    <p className="text-2xl font-medium text-center">
                      {t("No items in this category")}
                    </p>
                  </div>
                )}
              </div>
            </div>
          </Fragment>
        )}
      {(restaurantStyle?.category_alignment === t("Left") ||
        restaurantStyle?.category_alignment === "left") &&
        !isMobile && (
          <Fragment>
            <div
              style={{
                backgroundColor: restaurantStyle.product_background_color,
              }}
              className="w-full flex items-start p-16 gap-2 "
            >
              <div className="flex-[25%] laptopXL:flex-[20%]">
                <div
                  style={{
                    backgroundColor: restaurantStyle.page_category_color,
                    borderRadius: 12,
                  }}
                  className="w-[90%] py-3"
                >
                  <div className="flex flex-col items-center  px-3 gap-6">
                    {categories &&
                      categories?.map((category, i) => (
                        <span key={i}>
                          <CategoryItem
                            key={i}
                            valuekey={i}
                            active={selectedCategory.id === category.id}
                            name={category.name}
                            imgSrc={category.photo}
                            alt={category.name}
                            hoverColor={restaurantStyle?.category_hover_color}
                            onClick={() =>
                              dispatch(
                                selectedCategoryAPI({
                                  name: category.name,
                                  id: category.id,
                                })
                              )
                            }
                            textColor={restaurantStyle?.text_color}
                            textAlign={restaurantStyle?.text_alignment}
                            fontSize={restaurantStyle?.text_fontSize}
                            shape={restaurantStyle?.category_shape}
                            isGrid={true}
                          />
                        </span>
                      ))}
                  </div>
                </div>
              </div>
              <div className="flex-[75%] laptopXL:flex-[80%]">
                <div className="w-full">
                  {filterCategory &&
                    filterCategory.map((category,indx) => (
                      <div className="my-4" key={indx}>
                        <h3 className="font-semibold text-[1.5rem] relative">
                          <span className="custom-underline">
                            {category?.name}
                          </span>
                        </h3>
                        <div className="w-[95%] mt-10 ml-auto grid grid-col-1 md:grid-cols-2  laptopXL:grid-cols-3 gap-y-12 gap-x-6 py-10">
                          {category?.items
                            ?.filter((item) => item.availability === 1)
                            .map((product, i) => (
                              <span key={i}>
                              <ProductItem
                                key={product.id}
                                valuekey={product.id}
                                id={product.id}
                                name={product.description}
                                imgSrc={product.photo}
                                amount={product.price}
                                caloryInfo={product.calories}
                                checkbox_required={
                                  product?.checkbox_required ?? [
                                    "true",
                                    "false",
                                  ]
                                }
                                checkbox_input_titles={
                                  product?.checkbox_input_titles ?? [[]]
                                }
                                checkbox_input_names={
                                  product?.checkbox_input_names ?? [[]]
                                }
                                checkbox_input_prices={
                                  product?.checkbox_input_prices ?? [[]]
                                }
                                selection_required={
                                  product?.selection_required ?? [
                                    "true",
                                    "false",
                                  ]
                                }
                                selection_input_titles={
                                  product?.selection_input_titles ?? [[]]
                                }
                                selection_input_names={
                                  product?.selection_input_names ?? [[]]
                                }
                                selection_input_prices={
                                  product?.selection_input_prices ?? [[]]
                                }
                                dropdown_required={
                                  product?.dropdown_required ?? [
                                    "true",
                                    "false",
                                  ]
                                }
                                dropdown_input_titles={
                                  product?.dropdown_input_titles ?? [[]]
                                }
                                dropdown_input_names={
                                  product?.dropdown_input_names ?? [[]]
                                }
                                cartBgcolor={
                                  restaurantStyle?.categoryDetail_cart_color
                                }
                                amountColor={restaurantStyle?.price_color}
                                textColor={restaurantStyle?.text_color}
                                textAlign={restaurantStyle?.text_alignment}
                                fontSize={restaurantStyle?.text_fontSize}
                                shape={restaurantStyle?.categoryDetail_shape}
                              />
                              </span>
                            ))}
                        </div>
                      </div>
                    ))}
                </div>
              </div>
            </div>
          </Fragment>
        )}
      {(restaurantStyle?.category_alignment === t("Right") ||
        restaurantStyle?.category_alignment === "right") &&
        !isMobile && (
          <Fragment>
            <div
              style={{
                backgroundColor: restaurantStyle.product_background_color,
              }}
              className="w-full flex items-start p-16 gap-2"
            >
              <div className="flex-[75%] laptopXL:flex-[80%]">
                <div className="w-full py-4">
                  {filterCategory && filterCategory.length > 0 ? (
                    filterCategory.map((category, indx) => (
                      <div className="my-4" key={indx}>
                        <h3 className="font-semibold text-[1.5rem] relative">
                          <span className="custom-underline">
                            {category?.name}
                          </span>{" "}
                        </h3>
                        <div className="w-[95%] mt-10 ml-auto grid grid-cols-2 laptopXL:grid-cols-3 gap-y-12 gap-x-6 py-10">
                          {category?.items
                            ?.filter((item) => item.availability === 1)
                            .map((product, i) => (
                              <span key={i}>
                              <ProductItem
                                key={product.id}
                                valuekey={product.id}
                                id={product.id}
                                name={product.description}
                                imgSrc={product.photo}
                                amount={product.price}
                                caloryInfo={product.calories}
                                checkbox_required={
                                  product?.checkbox_required ?? [
                                    "true",
                                    "false",
                                  ]
                                }
                                checkbox_input_titles={
                                  product?.checkbox_input_titles ?? [[]]
                                }
                                checkbox_input_names={
                                  product?.checkbox_input_names ?? [[]]
                                }
                                checkbox_input_prices={
                                  product?.checkbox_input_prices ?? [[]]
                                }
                                selection_required={
                                  product?.selection_required ?? [
                                    "true",
                                    "false",
                                  ]
                                }
                                selection_input_titles={
                                  product?.selection_input_titles ?? [[]]
                                }
                                selection_input_names={
                                  product?.selection_input_names ?? [[]]
                                }
                                selection_input_prices={
                                  product?.selection_input_prices ?? [[]]
                                }
                                dropdown_required={
                                  product?.dropdown_required ?? [
                                    "true",
                                    "false",
                                  ]
                                }
                                dropdown_input_titles={
                                  product?.dropdown_input_titles ?? [[]]
                                }
                                dropdown_input_names={
                                  product?.dropdown_input_names ?? [[]]
                                }
                                cartBgcolor={
                                  restaurantStyle?.categoryDetail_cart_color
                                }
                                amountColor={restaurantStyle?.price_color}
                                textColor={restaurantStyle?.text_color}
                                textAlign={restaurantStyle?.text_alignment}
                                fontSize={restaurantStyle?.text_fontSize}
                                shape={restaurantStyle?.categoryDetail_shape}
                              />
                              </span>
                            ))}
                        </div>
                      </div>
                    ))
                  ) : (
                    <div className="w-full h-full items-center justify-center">
                      <p className="text-2xl font-medium text-center">
                        {t("No items in this category")}
                      </p>
                    </div>
                  )}
                </div>
              </div>
              <div className="flex-[25%] laptopXL:flex-[20%]">
                <div
                  style={{
                    backgroundColor: restaurantStyle.page_category_color,
                    borderRadius: 12,
                  }}
                  className="w-[90%] py-3"
                >
                  <div className="flex flex-col items-center gap-6">
                    {categories && categories.length > 0 ? (
                      categories.map((category, i) => (
                        <span key={i}>
                        <CategoryItem
                          key={i}
                          valuekey={i}
                          active={selectedCategory.id === category.id}
                          name={category.name}
                          imgSrc={category.photo}
                          alt={category.name}
                          hoverColor={restaurantStyle?.category_hover_color}
                          onClick={() =>
                            dispatch(
                              selectedCategoryAPI({
                                name: category.name,
                                id: category.id,
                              })
                            )
                          }
                          textColor={restaurantStyle?.text_color}
                          textAlign={restaurantStyle?.text_alignment}
                          fontSize={restaurantStyle?.text_fontSize}
                          shape={restaurantStyle?.category_shape}
                          isGrid={true}
                        />
                        </span>
                      ))
                    ) : (
                      <div className="w-full h-full items-center justify-center">
                        <p className="text-2xl font-medium text-center">
                          {t("No items in this category")}
                        </p>
                      </div>
                    )}
                  </div>
                </div>
              </div>
            </div>
          </Fragment>
        )}
    </div>
  );
};

export default ProductSection;
