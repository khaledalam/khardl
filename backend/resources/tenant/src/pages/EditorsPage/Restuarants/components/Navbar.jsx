import {Fragment, useContext} from "react"
import {FaPlay} from "react-icons/fa"
import {IoMenuOutline} from "react-icons/io5"
import {MenuContext} from "react-flexible-sliding-menu"

const Navbar = () => {
  const {toggleMenu} = useContext(MenuContext)

  const toggleTheMenu = () => {
    toggleMenu()
  }
  return (
    <Fragment>
      <div className='h-[70px] w-full bg-white flex items-center justify-between px-8'>
        <IoMenuOutline
          size={42}
          className='text-neutral-400'
          onClick={toggleTheMenu}
        />
        <div className='flex items-center gap-4'>
          <button className='btn btn-active p-3 bg-neutral-200 hover:bg-neutral-200 active:bg-neutral-200 flex items-center justify-center'>
            <FaPlay size={22} />
          </button>
          <button className='btn btn-active w-[100px] bg-neutral-200 hover:bg-neutral-200 active:bg-neutral-200'>
            Save
          </button>
        </div>
      </div>
    </Fragment>
  )
}

export default Navbar
