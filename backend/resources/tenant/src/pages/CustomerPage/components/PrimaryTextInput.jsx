import React from "react"

const PrimaryTextInput = ({
  label,
  placeholder,
  value,
  id,
  name,
  type = "text",
  onChange,
}) => {
  return (
    <label className='form-control w-full'>
      <div className='label'>
        <span className='label-text'>{label}</span>
      </div>
      <input
        type={type}
        id={id}
        name={name}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        className='input border-[var(--customer)] hover:border-[var(--customer)] focus-visible:border-[var(--customer)] outline-0 outline-none focus-visible:outline-none w-full'
      />
    </label>
  )
}

export default PrimaryTextInput
