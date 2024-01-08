import React, {Fragment} from "react"
import {RiMenuFoldFill, RiMenuUnfoldFill} from "react-icons/ri"
import SideNavbar from "./SideNavbar"
import {useSelector} from "react-redux"

const MobileMenu = () => {
  const language = useSelector((state) => state.languageMode.languageMode)

  return (
    <Fragment>
      <div
        className={`drawer lg:hidden ${language !== "en" ? "drawer-end" : ""}`}
      >
        <input id='mobile_en' type='checkbox' className='drawer-toggle' />
        <div className='drawer-content'>
          {/* Page content here */}
          <label htmlFor='mobile_en' className='lg:hidden drawer-button'>
            <RiMenuFoldFill
              size={35}
              className={`text-neutral-400 cursor-pointer ${
                language === "en" ? "ml-4" : "mr-4"
              }`}
            />
          </label>{" "}
        </div>
        <div className='drawer-side z-50 lg:hidden'>
          <label
            htmlFor='mobile_en'
            aria-label='close sidebar'
            className='drawer-overlay'
          ></label>
          <div className='menu lg:hidden bg-white p-4 w-72 md:w-80 min-h-full text-base-content'>
            <SideNavbar />
          </div>
        </div>
      </div>
    </Fragment>
  )
}

export default MobileMenu

/**  
 * 
 ) : (
        // <Fragment>
        //   <div className='drawer drawer-end'>
        //     <input id='mobile_ar' type='checkbox' className='drawer-toggle' />
        //     <div className='drawer-content'>
        //      
        //       <label htmlFor='mobile_ar' className='md:hidden drawer-button'>
        //         <RiMenuUnfoldFill
        //           size={35}
        //           className='text-neutral-400 cursor-pointer ml-4'
        //         />
        //       </label>{" "}
        //     </div>
        //     <div className='drawer-side z-50'>
        //       <label
        //         htmlFor='mobile_ar'
        //         aria-label='close sidebar'
        //         className='drawer-overlay'
        //       ></label>
        //       <div className='menu p-4 w-72 min-h-full bg-white text-base-content'>
        //         <SideNavbar />
        //       </div>
        //     </div>
        //   </div>
        // </Fragment>
 */
