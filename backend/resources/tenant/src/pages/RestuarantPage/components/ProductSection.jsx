import React, {Fragment, useState} from "react"
import {categoryList, productSectionList} from "../DATA"
import ProductItem from "../../EditorsPage/Restuarants/components/ProductItem"
import CategoryItem from "../../EditorsPage/Restuarants/components/CategoryItem"

const ProductSection = ({alignment}) => {
  const [selectedCategory, setSelectedCategory] = useState("burger")

  const filterProductList = productSectionList.filter(
    (product) => product.categoryName.toLowerCase() === selectedCategory
  )
  return (
    <Fragment>
      {alignment === "center" && (
        <Fragment>
          <div className='bg-white w-full'>
            <div className='w-5/6 laptopXL:w-[75%] mx-auto py-4'>
              {filterProductList.map((productSection) => (
                <div className='my-4' key={productSection.categoryName}>
                  <h3 className='font-semibold text-[1.5rem] relative'>
                    <span className='custom-underline'>
                      {productSection.categoryName}
                    </span>{" "}
                  </h3>
                  <div className='w-[95%] mt-10 ml-auto grid grid-cols-3 gap-y-12 gap-x-6 py-10'>
                    {productSection.productList.map((product, i) => (
                      <ProductItem
                        key={i}
                        id={product.name + i}
                        name={product.name}
                        imgSrc={product.imgSrc}
                        amount={product.amount}
                        caloryInfo={product.caloryInfo}
                        cartBgcolor={"#2A6E4F"}
                      />
                    ))}
                  </div>
                </div>
              ))}
            </div>
          </div>
        </Fragment>
      )}
      {alignment === "left" && (
        <Fragment>
          <div className='bg-white w-full flex items-start p-16 gap-2 '>
            <div className='flex-[20%]'>
              <div
                style={{
                  backgroundColor: "#2A6E4F",
                  borderRadius: 12,
                }}
                className='w-[90%] py-3'
              >
                <div className='flex flex-col items-center gap-6'>
                  {categoryList.map((category, i) => (
                    <CategoryItem
                      key={i}
                      active={selectedCategory === category.name.toLowerCase()}
                      name={category.name}
                      imgSrc={category.imgSrc}
                      alt={category.name}
                      hoverColor={"red"}
                      onClick={() =>
                        setSelectedCategory(category.name.toLowerCase())
                      }
                      textColor={"#333"}
                      shape={"rounded"}
                      isGrid={true}
                    />
                  ))}
                </div>
              </div>
            </div>
            <div className='flex-[80%]'>
              <div className='w-full'>
                {filterProductList.map((productSection) => (
                  <div className='my-4' key={productSection.categoryName}>
                    <h3 className='font-semibold text-[1.5rem] relative'>
                      <span className='custom-underline'>
                        {productSection.categoryName}
                      </span>{" "}
                    </h3>
                    <div className='w-[95%] mt-10 ml-auto grid grid-cols-3 gap-y-12 gap-x-6 py-10'>
                      {productSection.productList.map((product, i) => (
                        <ProductItem
                          key={i}
                          id={product.name + i}
                          name={product.name}
                          imgSrc={product.imgSrc}
                          amount={product.amount}
                          caloryInfo={product.caloryInfo}
                          cartBgcolor={"#2A6E4F"}
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
      {alignment === "right" && (
        <Fragment>
          <div className='bg-white w-full flex items-start p-16 gap-2'>
            <div className='flex-[80%]'>
              <div className='w-full py-4'>
                {filterProductList.map((productSection) => (
                  <div className='my-4' key={productSection.categoryName}>
                    <h3 className='font-semibold text-[1.5rem] relative'>
                      <span className='custom-underline'>
                        {productSection.categoryName}
                      </span>{" "}
                    </h3>
                    <div className='w-[95%] mt-10 ml-auto grid grid-cols-3 gap-y-12 gap-x-6 py-10'>
                      {productSection.productList.map((product, i) => (
                        <ProductItem
                          key={i}
                          id={product.name + i}
                          name={product.name}
                          imgSrc={product.imgSrc}
                          amount={product.amount}
                          caloryInfo={product.caloryInfo}
                          cartBgcolor={"#2A6E4F"}
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
                  {categoryList.map((category, i) => (
                    <CategoryItem
                      key={i}
                      active={selectedCategory === category.name.toLowerCase()}
                      name={category.name}
                      imgSrc={category.imgSrc}
                      alt={category.name}
                      hoverColor={"red"}
                      onClick={() =>
                        setSelectedCategory(category.name.toLowerCase())
                      }
                      textColor={"#333"}
                      shape={"rounded"}
                      isGrid={true}
                    />
                  ))}
                </div>
              </div>
            </div>
          </div>
        </Fragment>
      )}
    </Fragment>
  )
}

export default ProductSection
