import React from "react"
import imgCardSim from "../../../assets/cardSim.svg"
import imgVisa from "../../../assets/visa.svg"
import imgMasterCard from "../../../assets/mastercard.svg"
import {MdMoreVert} from "react-icons/md"

const CardPayment = () => {
  return (
    <div className='relative p-4 h-[270px] w-[470px] flex items-center justify-center border border-[var(--customer)] rounded-xl'>
      <div onClick={() => {}} className='absolute top-2 right-2 cursor-pointer'>
        <MdMoreVert size={26} color={"#E16449"} />
      </div>
      <div className='relative w-[400px] h-full text-white'>
        <div
          className='h-[200px] w-[400px] flex items-center justify-center absolute top-0 right-0 left-0 rounded-xl'
          style={{background: " rgba(225, 100, 73, 0.62)"}}
        >
          <div className='h-6 w-full bg-black'></div>
        </div>
        <div
          className='h-[200px] w-[390px] absolute top-6 right-2 left-[-0.8rem] rounded-xl'
          style={{
            background:
              "linear-gradient(125deg, rgba(225,100,73,1) 58%, rgba(242,36,35,1) 58%)",
          }}
        >
          <div className='w-full h-full p-4 flex flex-col gap-5 text-white'>
            <div className='w-full flex items-start justify-between'>
              <div className='flex flex-col gap-1'>
                <h3 className=''>Fincard</h3>
                <img src={imgCardSim} alt='' className='w-[40px] h-[30px] ' />
              </div>
              <h3 className='font-bold text-sm'>{"Platinum Debit"}</h3>
            </div>
            <div className='w-full'>
              <h3 className='font-bold text-xl'>5214 32** **** 1673</h3>
            </div>
            <div className='w-full flex items-center mt-2 justify-between'>
              <h3 className=''>Valid Thru {"11/23"}</h3>
              <img src={imgVisa} alt='' className='' />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default CardPayment
