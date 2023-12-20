import {FaPlay} from "react-icons/fa"
import {IoMenuOutline} from "react-icons/io5"

const Navbar = () => {
  return (
    <div className='h-[70px] w-full bg-white flex items-center justify-between px-8'>
      <IoMenuOutline size={42} />
      <div className='flex items-center gap-4'>
        <button className='btn btn-active p-3 flex items-center justify-center'>
          <FaPlay size={22} />
        </button>
        <button className='btn btn-active w-[100px]'>Save</button>
      </div>
    </div>
  )
}

export default Navbar
