import React, {Fragment, useState} from "react"
import ProductItem from "../../EditorsPage/Restuarants/components/ProductItem"
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem"
import {useDispatch, useSelector} from "react-redux"
import {selectedCategoryAPI} from "../../../redux/NewEditor/categoryAPISlice"

const ProductSection = ({categories}) => {
  const dispatch = useDispatch()
  const selectedCategory = useSelector(
    (state) => state.categoryAPI.selected_category
  )
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle)

  const filterCategory =
    categories && categories.length > 0
      ? categories?.filter(
          (category) =>
            category.name.toLowerCase() === selectedCategory.toLowerCase()
        )
      : [{name: "", items: []}]

  console.log("filterCategory", filterCategory)
  return (
    <div>
      {restaurantStyle?.category_alignment === "center" && (
        <Fragment>
          <div className='w-full'>
            <div className='w-5/6 laptopXL:w-[75%] mx-auto py-4'>
              {filterCategory &&
                filterCategory.map((category) => (
                  <div className='my-4' key={category.id}>
                    <h3 className='font-semibold text-[1.5rem] relative'>
                      <span className='custom-underline'>{category?.name}</span>{" "}
                    </h3>
                    <div className='w-[95%] mt-10 ml-auto grid grid-cols-3 gap-y-12 gap-x-6 py-10'>
                      {category?.items?.map((product, i) => (
                        <ProductItem
                          key={product.id}
                          id={product.id}
                          name={product.description}
                          imgSrc={product.photo}
                          amount={product.price}
                          caloryInfo={product.calories}
                          cartBgcolor={
                            restaurantStyle?.categoryDetail_cart_color
                          }
                          amountColor={restaurantStyle?.price_color}
                          fontSize={restaurantStyle?.text_fontSize}
                          shape={restaurantStyle?.categoryDetail_shape}
                        />
                      ))}
                    </div>
                  </div>
                ))}
            </div>
          </div>
        </Fragment>
      )}
      {restaurantStyle?.category_alignment === "left" && (
        <Fragment>
          <div className='w-full flex items-start p-16 gap-2 '>
            <div className='flex-[20%]'>
              <div
                style={{
                  backgroundColor: "#2A6E4F",
                  borderRadius: 12,
                }}
                className='w-[90%] py-3'
              >
                <div className='flex flex-col items-center gap-6'>
                  {categories &&
                    categories?.map((category, i) => (
                      <CategoryItem
                        key={i}
                        active={
                          selectedCategory === category.name.toLowerCase()
                        }
                        name={category.name}
                        imgSrc={category.imgSrc}
                        alt={category.name}
                        hoverColor={restaurantStyle?.category_hover_color}
                        onClick={() =>
                          dispatch(
                            selectedCategoryAPI(category.name.toLowerCase())
                          )
                        }
                        textColor={restaurantStyle?.text_color}
                        fontSize={restaurantStyle?.text_fontSize}
                        shape={restaurantStyle?.category_shape}
                        isGrid={true}
                      />
                    ))}
                </div>
              </div>
            </div>
            <div className='flex-[80%]'>
              <div className='w-full'>
                {filterCategory &&
                  filterCategory.map((category) => (
                    <div className='my-4' key={category.id}>
                      <h3 className='font-semibold text-[1.5rem] relative'>
                        <span className='custom-underline'>
                          {category?.name}
                        </span>{" "}
                      </h3>
                      <div className='w-[95%] mt-10 ml-auto grid grid-cols-3 gap-y-12 gap-x-6 py-10'>
                        {category?.items?.map((product, i) => (
                          <ProductItem
                            key={product.id}
                            id={product.id}
                            name={product.description}
                            imgSrc={product.photo}
                            amount={product.price}
                            caloryInfo={product.calories}
                            cartBgcolor={
                              restaurantStyle?.categoryDetail_cart_color
                            }
                            amountColor={restaurantStyle?.price_color}
                            fontSize={restaurantStyle?.text_fontSize}
                            shape={restaurantStyle?.categoryDetail_shape}
                          />
                        ))}
                      </div>
                    </div>
                  ))}
              </div>
            </div>
          </div>
        </Fragment>
      )}
      {restaurantStyle?.category_alignment === "right" && (
        <Fragment>
          <div className='w-full flex items-start p-16 gap-2'>
            <div className='flex-[80%]'>
              <div className='w-full py-4'>
                {filterCategory &&
                  filterCategory.map((category) => (
                    <div className='my-4' key={category.id}>
                      <h3 className='font-semibold text-[1.5rem] relative'>
                        <span className='custom-underline'>
                          {category?.name}
                        </span>{" "}
                      </h3>
                      <div className='w-[95%] mt-10 ml-auto grid grid-cols-3 gap-y-12 gap-x-6 py-10'>
                        {category?.items?.map((product, i) => (
                          <ProductItem
                            key={product.id}
                            id={product.id}
                            name={product.description}
                            imgSrc={product.photo}
                            amount={product.price}
                            caloryInfo={product.calories}
                            cartBgcolor={
                              restaurantStyle?.categoryDetail_cart_color
                            }
                            amountColor={restaurantStyle?.price_color}
                            fontSize={restaurantStyle?.text_fontSize}
                            shape={restaurantStyle?.categoryDetail_shape}
                          />
                        ))}
                      </div>
                    </div>
                  ))}
              </div>
            </div>
            <div className='flex-[20%]'>
              <div
                style={{
                  backgroundColor: "#2A6E4F",
                  borderRadius: 12,
                }}
                className='w-[90%] py-3'
              >
                <div className='flex flex-col items-center gap-6'>
                  {categories &&
                    categories?.map((category, i) => (
                      <CategoryItem
                        key={i}
                        active={
                          selectedCategory === category.name.toLowerCase()
                        }
                        name={category.name}
                        imgSrc={category.imgSrc}
                        alt={category.name}
                        hoverColor={restaurantStyle?.category_hover_color}
                        onClick={() =>
                          dispatch(
                            selectedCategoryAPI(category.name.toLowerCase())
                          )
                        }
                        textColor={restaurantStyle?.text_color}
                        fontSize={restaurantStyle?.text_fontSize}
                        shape={restaurantStyle?.category_shape}
                        isGrid={true}
                      />
                    ))}
                </div>
              </div>
            </div>
          </div>
        </Fragment>
      )}
    </div>
  )
}

export default ProductSection
