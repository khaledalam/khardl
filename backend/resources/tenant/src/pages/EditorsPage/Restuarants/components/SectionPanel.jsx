import React, {Fragment} from "react"
import PrimarySelect from "./PrimarySelect"
import LogoAlignment from "./LogoAlignment"
import CategoryAlign from "./CategoryAlign"

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
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Banner</h2>
        <PrimarySelect
          defaultValue={"One-Page"}
          options={[
            {value: "one-page", text: "One-Page"},
            {value: "two-page", text: "Two-Page"},
            {value: "three-page", text: "Three-Page"},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Category</h2>
        <CategoryAlign />
        <PrimarySelect
          label={"Content"}
          defaultValue={"Center"}
          options={[
            {value: "left", text: "Left"},
            {value: "center", text: "Center"},
            {value: "right", text: "Right"},
          ]}
        />
      </div>
    </div>
  )
}

export default SectionPanel
