import React, {Fragment} from "react"
import {RiMenuFoldFill, RiMenuUnfoldFill} from "react-icons/ri"
import SideNavbar from "./SideNavbar"
import {useSelector} from "react-redux"

const MobileMenu = () => {
  const language = useSelector((state) => state.languageMode.languageMode)

  return (
    <Fragment>
      {language === "en" ? (
        <Fragment>
          <div className='drawer'>
            <input id='my-drawer' type='checkbox' className='drawer-toggle' />
            <div className='drawer-content'>
              {/* Page content here */}
              <label htmlFor='my-drawer' className='md:hidden drawer-button'>
                <RiMenuFoldFill
                  size={35}
                  className='text-neutral-400 cursor-pointer ml-4'
                />
              </label>{" "}
            </div>
            <div className='drawer-side z-50'>
              <label
                htmlFor='my-drawer'
                aria-label='close sidebar'
                className='drawer-overlay'
              ></label>
              <div className='menu bg-white p-4 w-72 min-h-full text-base-content'>
                <SideNavbar />
              </div>
            </div>
          </div>
        </Fragment>
      ) : (
        <Fragment>
          <div className='drawer drawer-end'>
            <input id='my-drawer-4' type='checkbox' className='drawer-toggle' />
            <div className='drawer-content'>
              {/* Page content here */}
              <label htmlFor='my-drawer' className='md:hidden drawer-button'>
                <RiMenuUnfoldFill
                  size={35}
                  className='text-neutral-400 cursor-pointer ml-4'
                />
              </label>{" "}
            </div>
            <div className='drawer-side'>
              <label
                htmlFor='my-drawer-4'
                aria-label='close sidebar'
                className='drawer-overlay'
              ></label>
              <div className='menu p-4 w-72 min-h-full bg-white text-base-content'>
                <SideNavbar />
              </div>
            </div>
          </div>
        </Fragment>
      )}
    </Fragment>
  )
}

export default MobileMenu
