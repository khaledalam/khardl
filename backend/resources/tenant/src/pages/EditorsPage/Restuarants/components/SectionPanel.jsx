import React, {Fragment, useCallback, useState} from "react"
import PrimarySelect from "./PrimarySelect"
import LogoAlignment from "./LogoAlignment"
import CategoryAlign from "./CategoryAlign"

const SectionPanel = () => {
  const [position, setPosition] = useState("Fixed")
  const [banner, setBanner] = useState("One-Page")
  const [content, setContent] = useState("Center")

  return (
    <div className='p-2 w-full'>
      <div className='pb-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Header</h2>
        <PrimarySelect
          label={"Position"}
          defaultValue={position}
          handleChange={(value) => setPosition(value)}
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
          defaultValue={banner}
          handleChange={(value) => setBanner(value)}
          options={[
            {value: "slider", text: "Slider"},
            {value: "one-page", text: "One-Page"},
          ]}
        />
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Category</h2>
        <CategoryAlign label={"Type"} />
        <div className='mt-3'>
          <PrimarySelect
            label={"Content"}
            defaultValue={content}
            handleChange={(value) => setContent(value)}
            options={[
              {value: "left", text: "Left"},
              {value: "center", text: "Center"},
              {value: "right", text: "Right"},
            ]}
          />
        </div>
      </div>
      <div className='py-4 border-b border-neutral-300'>
        <h2 className='font-bold text-lg mb-4'>Category Details</h2>
        <CategoryAlign label={"Type"} />
        <div className='mt-3'>
          <PrimarySelect
            label={"Content"}
            defaultValue={content}
            handleChange={(value) => setContent(value)}
            options={[
              {value: "left", text: "Left"},
              {value: "center", text: "Center"},
              {value: "right", text: "Right"},
            ]}
          />
        </div>
      </div>
    </div>
  )
}

export default SectionPanel
