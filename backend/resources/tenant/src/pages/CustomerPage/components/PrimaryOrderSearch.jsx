import React from "react"
import {useTranslation} from "react-i18next"
import {BsSearch} from "react-icons/bs"

const PrimaryOrderSearch = ({value, onChange}) => {
  const {t} = useTranslation()
  return (
    <div className='w-full p-2 mx-auto flex flex-row gap-2 h-10 bg-neutral-100 rounded-2xl border border-[var(--customer)] items-center cursor-pointer '>
      <div className='flex items-center'>
        <BsSearch />
      </div>
      <input
        placeholder={t("Search")}
        id={"search-input"}
        name={"search-input"}
        value={value}
        onChange={onChange}
        className={`input w-full bg-transparent border-none hover:border-none outline-none focus-visible:border-none focus-visible:outline-none`}
      />
    </div>
  )
}

export default PrimaryOrderSearch
