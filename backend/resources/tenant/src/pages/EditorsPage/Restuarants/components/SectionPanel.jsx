import React from "react"
import PrimarySelect from "./PrimarySelect"
import LogoAlignment from "./LogoAlignment"

const SectionPanel = () => {
  return (
    <div className='p-2 w-full'>
      <div className='pb-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Header</h2>
        <PrimarySelect
          label={"Position"}
          defaultValue={"Fixed"}
          options={[
            {value: "fixed", text: "Fixed"},
            {value: "relative", text: "Relative"},
            {value: "absolute", text: "Absolute"},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300 flex items-center gap-4'>
        <h2 className='font-bold text-lg mb-4'>Logo</h2>
        <LogoAlignment />
      </div>
    </div>
  )
}

export default SectionPanel
