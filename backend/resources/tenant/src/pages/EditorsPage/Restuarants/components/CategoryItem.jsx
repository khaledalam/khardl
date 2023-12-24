import React, {useState} from "react"

const CategoryItem = ({
  active,
  imgSrc,
  alt,
  name,
  onClick,
  hoverColor,
  textColor,
}) => {
  const [isHover, setIsHover] = useState(false)

  const handleMouseEnter = () => {
    setIsHover((prev) => !prev)
    console.log("mouse Enter")
  }

  const handleMouseLeave = () => {
    setIsHover((prev) => !prev)
    console.log("mouse leave")
  }
  console.log("is hover", isHover)
  return (
    <div
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
      className='flex flex-col gap-3 items-center justify-center'
    >
      <div
        style={{
          backgroundColor: isHover ? hoverColor : "#F5F5F5",
        }}
        onClick={onClick}
        className={`w-[75px] h-[75px] p-2 rounded-full flex items-center justify-center scale-100 hover:scale-125 transition-all duration-300   bg-neutral-100  `}
      >
        <div className='w-[50px] h-[50px] flex items-center justify-center'>
          <img src={imgSrc} alt={alt} className='w-full h-full object-cover' />
        </div>
      </div>
      <h3 style={{color: textColor}} className='text-sm font-normal'>
        {name}
      </h3>
    </div>
  )
}

export default CategoryItem
