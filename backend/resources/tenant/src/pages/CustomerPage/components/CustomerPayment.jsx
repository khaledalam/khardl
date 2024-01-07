import React from "react"
import CardPayment from "./CardPayment"
import imgPayment from "../../../assets/cardProfileIcon.svg"

const CustomerPayment = () => {
  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={imgPayment} alt='Payment' className='' />
        <h3 className='text-xl font-medium'>Payment</h3>
      </div>
      <h3 className='border-b inline-block border-[var(--customer)] text-xl pb-1 my-5'>
        My Card
      </h3>
      <div className=''>
        <CardPayment />
      </div>
    </div>
  )
}

export default CustomerPayment
