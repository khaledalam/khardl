import React, {useState} from "react"
import PrimarySelect from "./PrimarySelect"

const EditPanel = () => {
  const [logoShape, setLogoShape] = useState("Rounded")

  return (
    <div className='w-full h-full'>
      <div className='py-4 border-b border-neutral-300 px-2'>
        <h2 className='font-bold text-lg mb-4'>Shape</h2>
        <div className='flex flex-col gap-4'>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-lg'>Logo</h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-lg'>Banner</h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-lg'>Category</h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
          <div className='flex w-full justify-between items-center'>
            <h3 className='font-normal text-lg'>Category Detail</h3>
            <PrimarySelect
              widthStyle={"w-[50%]"}
              defaultValue={logoShape}
              handleChange={(value) => setLogoShape(value)}
              options={[
                {value: "rounded", text: "Rounded"},
                {value: "rounded", text: "Rounded"},
              ]}
            />
          </div>
        </div>
      </div>
    </div>
  )
}

export default EditPanel
