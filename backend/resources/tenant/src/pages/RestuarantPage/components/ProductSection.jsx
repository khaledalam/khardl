import React from "react"
import {productSectionList} from "../DATA"
import ProductItem from "../../EditorsPage/Restuarants/components/ProductItem"

const ProductSection = () => {
  return (
    <div className='bg-white w-full'>
      <div className='w-5/6 laptopXL:w-[75%] mx-auto py-4'>
        {productSectionList.map((productSection) => (
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
  )
}

export default ProductSection
