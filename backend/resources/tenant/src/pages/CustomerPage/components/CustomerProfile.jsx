import React from "react"
import profileIcon from "../../../assets/profileIcon.svg"
import PrimaryTextInput from "./PrimaryTextInput"

const CustomerProfile = () => {
  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={profileIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>Profile</h3>
      </div>
      <h3 className='text-lg my-5 '>Profile Detail</h3>
      <div className='w-full bg-white shadow-md  min-h-[300px] h-full p-4'>
        <div className='w-1/3 flex flex-col gap-4'>
          <PrimaryTextInput
            id={"first-name"}
            name={"first-name"}
            label={"First Name"}
            placeholder={"First name"}
          />
          <PrimaryTextInput
            id={"last-name"}
            name={"last-name"}
            label={"Last Name"}
            placeholder={"Last name"}
          />
          <PrimaryTextInput
            id={"phone-number"}
            name={"phone-number"}
            type='tel'
            label={"Phone Number"}
            placeholder={"Phone Number"}
          />
        </div>
      </div>
      <h3 className='text-lg my-5 '>Location</h3>
      <div className='w-full bg-white shadow-md  min-h-[500px] h-full p-4'>
        <div className='w-1/3 flex flex-col gap-4'>
          <PrimaryTextInput
            id={"address"}
            name={"address"}
            label={"Address"}
            placeholder={"Search for your location..."}
          />
        </div>
      </div>
    </div>
  )
}

export default CustomerProfile
