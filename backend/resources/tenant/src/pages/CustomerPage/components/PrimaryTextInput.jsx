import React from "react";

const PrimaryTextInput = ({
  label,
  placeholder,
  value,
  id,
  name,
  type = "text",
  onChange,
  disabled = false,
}) => {
  return (
    <label className="h-fit form-control w-full">
      <div className="label">
        <span className="label-text">{label}:</span>
      </div>
      <input
        disabled={disabled}
        type={type}
        id={id}
        name={name}
        placeholder={placeholder}
        value={value}
        onChange={(event) => onChange(event.target.value)}
        className="input bg-white w-full outline-none focus-visible:outline-none p-2 text-sm placeholder:text-neutral-500 h-fit text-neutral-900  rounded-2xl border border-neutral-700 hover:border-black focus-visible:border-black disabled:border-neutral-700"
      />
    </label>
  );
};

export default PrimaryTextInput;
