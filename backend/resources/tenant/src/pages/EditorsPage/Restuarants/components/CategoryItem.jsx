import React, {useState} from "react"
import ImgBurger from "../../../../assets/burger.png"

const CategoryItem = ({
  active,
  imgSrc,
  alt,
  name,
  onClick,
  hoverColor,
  textColor,
  shape,
  isGrid,
  fontSize,
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
      onClick={onClick}
      className={`flex w-5/6 ${
        isGrid ? "flex-row" : "flex-col"
      } gap-3 items-center`}
    >
      <div
        style={{
          backgroundColor: isHover
            ? hoverColor
            : active
            ? hoverColor
            : "#F5F5F5",
        }}
        className={`w-[75px] h-[75px] p-2  ${
          shape === "sharp" ? "" : "rounded-full"
        }  flex items-center justify-center scale-100 hover:scale-125 transition-all duration-300   bg-neutral-100  `}
      >
        <div
          className={`w-[50px] h-[50px] flex items-center ${
            shape === "sharp" ? "" : "rounded-full"
          } justify-center`}
        >
          <img
            src={imgSrc ? imgSrc : ImgBurger}
            alt={alt}
            className={`w-full h-full object-cover ${
              shape === "sharp" ? "" : "rounded-full"
            } `}
          />
        </div>
      </div>
      <h3
        style={{
          color: textColor,
          fontSize:
            fontSize && typeof fontSize == "string" && fontSize.includes("px")
              ? Number(fontSize.slice(0, 2)) - 2
              : typeof fontSize == "number"
              ? fontSize - 2
              : 14,
        }}
        className='font-normal w-max'
      >
        {name}
      </h3>
    </div>
  )
}

export default CategoryItem
