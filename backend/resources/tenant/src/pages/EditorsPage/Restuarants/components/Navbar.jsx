import {Fragment} from "react"
import {FaPlay} from "react-icons/fa"
import {IoMenuOutline} from "react-icons/io5"
import OuterSidebarNav from "./OuterSidebarNav"

const Navbar = () => {
  return (
    <Fragment>
      <div className='h-[70px] w-full bg-white flex items-center justify-between px-8'>
        <label htmlFor='my-drawer' className='drawer-button'>
          <IoMenuOutline size={42} className='text-neutral-400' />
        </label>
        <div className='flex items-center gap-4'>
          <button className='btn btn-active p-3 bg-neutral-200 hover:bg-neutral-200 active:bg-neutral-200 flex items-center justify-center'>
            <FaPlay size={22} />
          </button>
          <button className='btn btn-active w-[100px] bg-neutral-200 hover:bg-neutral-200 active:bg-neutral-200'>
            Save
          </button>
        </div>
      </div>
      <div className='drawer z-50'>
        <input id='my-drawer' type='checkbox' className='drawer-toggle' />
        <div className='drawer-side'>
          <label
            htmlFor='my-drawer'
            aria-label='close sidebar'
            className='drawer-overlay'
          ></label>
          <div className='menu p-4 laptopXL:w-[25%] w-[30%] min-h-full bg-white text-base-content'>
            {/* Sidebar content here */}
            <OuterSidebarNav />
          </div>
        </div>
      </div>
    </Fragment>
  )
}

export default Navbar
