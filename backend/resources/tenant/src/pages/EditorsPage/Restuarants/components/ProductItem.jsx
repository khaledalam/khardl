import React, {Fragment} from "react"
import imgCart from "../../../../assets/headerCartIcon.svg"
import imgCartWhite from "../../../../assets/cartWhiteIcon.svg"
import {PiNoteFill} from "react-icons/pi"
import {MdSend} from "react-icons/md"

const ProductItem = ({
  id,
  imgSrc,
  name,
  caloryInfo,
  amount,
  cartBgcolor,
  amountColor,
}) => {
  return (
    <Fragment>
      <div
        style={{boxShadow: "4px 0px 10px 0px rgba(0, 0, 0, 0.25)"}}
        className='w-[250px] min-h-[138px] rounded-2xl'
        onClick={() => document.getElementById(id).showModal()}
      >
        <div className='flex items-center justify-between pt-2'>
          <div className='flex flex-col gap-2 pl-4'>
            <h3 className='font-bold text-[1rem]'>{name}</h3>
            <p className='font-normal text-[12px]'>{caloryInfo}</p>
          </div>
          <div className='w-[100px] h-[100px] mr-[-1.8rem]'>
            <img
              src={imgSrc}
              alt='product'
              className='w-full h-full object-contain'
            />
          </div>
        </div>
        <div className='flex-1 h-full'>
          <div className='flex gap-6 w-full'>
            <div
              style={{backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00"}}
              className='w-[70px] h-[30px] p-1 rounded-tr-lg rounded-bl-2xl  flex items-center justify-center'
            >
              <img
                src={cartBgcolor ? imgCartWhite : imgCart}
                alt='product'
                className='w-full h-full object-contain '
              />
            </div>
            <h3
              style={{color: amountColor ? amountColor : "red"}}
              className=' font-bold'
            >
              SAR {amount}
            </h3>
          </div>
        </div>
      </div>
      {/* You can open the modal using document.getElementById('ID').showModal() method */}
      <dialog id={id} className='modal'>
        <div
          style={{backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00"}}
          className='modal-box !p-0 rounded-[46px] w-[440px] h-[601px] flex flex-col justify-end'
        >
          <form method='dialog'>
            {/* if there is a button in form, it will close the modal */}
            <button className='btn btn-xs btn-circle bg-white hover:bg-white text-black absolute right-6 top-6'>
              ✕
            </button>
            {/* <IoCloseCircleOutline size={22}/> */}
          </form>
          <div className='bg-white w-full rounded-t-[80px] h-[460px] '>
            <div className='w-[216px] h-[182px] mt-[-5.8rem] mx-auto'>
              <img
                src={imgSrc}
                alt='product'
                className='w-full h-full object-contain'
              />
            </div>
            <div className='flex flex-col items-center justify-center gap-4'>
              <h3 className=''>{name}</h3>
              <div className='flex flex-row items-center gap-2'>
                <img src={""} alt='' className='' />
                <span className=''>{caloryInfo}</span>
              </div>
              <div className='flex flex-row items-end'>
                <span className='text-[13px]'>SAR</span>
                <span className='text-[17px]'>{amount}</span>
              </div>
            </div>
            <div className='w-[90%] mx-auto'>
              <h3 className='text-[1rem] font-bold mb-4'>Feedback</h3>
              <div className='w-full flex items-center gap-4'>
                <div className='border border-neutral-200 rounded-lg w-[85%] h-[48px] flex items-center gap-2 px-2'>
                  <PiNoteFill
                    size={28}
                    className='border-r border-neutral-100'
                  />
                  <input
                    type='text'
                    placeholder='Say something nice...'
                    className='input w-full  h-full rounded-none outline-none border-none focus-visible:border-none focus-within:border-none focus-within:outline-none'
                  />
                </div>
                <div className='w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center'>
                  <MdSend size={22} />
                </div>
              </div>
            </div>
          </div>
        </div>
      </dialog>
    </Fragment>
  )
}

export default ProductItem
