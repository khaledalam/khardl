import React, {useContext} from "react"
import {MenuContext} from "react-flexible-sliding-menu"
import {IoMenuOutline} from "react-icons/io5"
import cartHeaderImg from "../../../../assets/cartBoldIcon.svg"
import {useNavigate} from "react-router-dom"
import {useSelector} from "react-redux"

const HeaderEdit = ({restaurantStyle}) => {
  const {toggleMenu} = useContext(MenuContext)
  const navigate = useNavigate()
  const cartItemsCount = useSelector(
    (state) => state.categoryAPI.cartItemsCount
  )

  return (
    <div
      style={{
        backgroundColor: restaurantStyle?.header_color,
      }}
      className='w-full min-h-[85px] z-10  rounded-xl flex items-center justify-between px-2'
    >
      <div
        onClick={toggleMenu}
        style={{fontWeight: restaurantStyle?.text_fontWeight}}
        className={`btn hover:bg-neutral-100 flex items-center gap-3 cursor-pointer`}
      >
        <IoMenuOutline size={40} className='text-neutral-400' />
        {/* <span className='text-sm'>{t("Show Navigation Bar To Edit")}</span> */}
      </div>
      <div
        onClick={() => navigate("/cart")}
        className='w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center cursor-pointer'
      >
        <img src={cartHeaderImg} alt={"cart"} className='' />
        {true && (
          <div className='absolute top-[-0.5rem] right-[-0.5rem]'>
            <div className='w-[20px] h-[20px] rounded-full p-1 bg-red-500 flex items-center justify-center'>
              <span className='text-white font-bold text-xs'>
                {cartItemsCount}
              </span>
            </div>
          </div>
        )}
      </div>
    </div>
  )
}

export default HeaderEdit
