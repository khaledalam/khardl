import React from "react"
import imgCardSim from "../../../assets/cardSim.svg"
import {MdMoreVert} from "react-icons/md"

const CardPayment = ({poweredByImgURl, CardNumber, ValidThruNo}) => {
  return (
    <div className='relative p-4 h-[270px] w-[430px] flex items-center justify-center border border-[var(--customer)] rounded-xl'>
      <div className='dropdown absolute top-2 right-2'>
        <div tabIndex={0} role='button' className=''>
          <MdMoreVert size={26} color={"#E16449"} />
        </div>
        <ul
          tabIndex={0}
          className='dropdown-content z-[2] menu shadow bg-base-100 rounded-lg w-52 h-[54px]'
        >
          <li className='bg-[var(--customer)] text-white font-bold text-center w-full p-2 cursor-pointer'>
            Delete
          </li>
        </ul>
      </div>

      <div className='relative w-[350px] h-full text-white'>
        <div
          className='h-[200px] w-[350px] flex items-center justify-center absolute top-0 right-0 left-0 rounded-xl'
          style={{background: " rgba(225, 100, 73, 0.62)"}}
        >
          <div className='h-6 w-full bg-black'></div>
        </div>
        <div
          className='h-[200px] w-[350px] absolute top-6 right-2 left-[-0.8rem] rounded-xl'
          style={{
            background:
              "linear-gradient(125deg, rgba(225,100,73,1) 58%, rgba(242,36,35,1) 58%)",
          }}
        >
          <div className=' h-full p-4 flex flex-col gap-5 text-white'>
            <div className='w-full flex items-start justify-between'>
              <div className='flex flex-col gap-1'>
                <h3 className=''>Fincard</h3>
                <img src={imgCardSim} alt='' className='w-[40px] h-[30px] ' />
              </div>
              <h3 className='font-bold text-sm'>{"Platinum Debit"}</h3>
            </div>
            <div className='w-full'>
              <h3 className='font-bold text-xl'>{CardNumber}</h3>
            </div>
            <div className='w-full flex items-center mt-2 justify-between'>
              <h3 className=''>Valid Thru {ValidThruNo}</h3>
              <img src={poweredByImgURl} alt='' className='' />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default CardPayment
