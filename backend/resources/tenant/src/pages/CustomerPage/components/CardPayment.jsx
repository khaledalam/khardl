import React from "react"
import imgCardSim from "../../../assets/cardSim.svg"
import imgThumbUp from "../../../assets/thumbup.svg"
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
          <li
            onClick={() => document.getElementById("my_modal_3").showModal()}
            className='bg-[var(--customer)] text-white font-bold text-center w-full p-2 cursor-pointer'
          >
            Delete
          </li>
        </ul>
      </div>
      {/* You can open the modal using document.getElementById('ID').showModal() method */}
      <dialog id='my_modal_3' className='modal bg-[#D9D9D99C]'>
        <div className='modal-box bg-[#FF3D00] h-40 w-64'>
          <form method='dialog'>
            {/* if there is a button in form, it will close the modal */}
            <button className='btn btn-xs btn-circle bg-white hover:bg-white text-black absolute right-6 top-6'>
              ✕
            </button>
          </form>
          <div className='w-full h-full flex items-center justify-center gap-3 flex-col'>
            <img src={imgThumbUp} alt='ThumbUp' className='' />
            <h3 className='text-[1rem] font-bold text-white'>
              Card have been deleted
            </h3>
          </div>
        </div>
      </dialog>

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
