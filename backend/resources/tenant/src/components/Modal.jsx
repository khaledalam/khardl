import React, { useEffect, useRef } from "react";

export default function Modal({
  open,
  children,
  onClose,
  className,
  noBackground,
}) {
  const modalRef = useRef(null);

  useEffect(() => {
    const handleOutsideClick = (event) => {
      if (!open || !modalRef.current) return;

      if (!modalRef.current.contains(event.target)) {
        onClose();
      }
    };

    document.addEventListener("mousedown", handleOutsideClick);

    return () => {
      document.removeEventListener("mousedown", handleOutsideClick);
    };
  }, [open, onClose]);

  if (!open) return null;

  return (
    <>
      <div
        className={`${
          noBackground
            ? "fixed top-0 left-0 right-0 bottom-0 z-[999]"
            : "fixed top-0 left-0 right-0 bottom-0 bg-black/[0.7] z-[999]"
        }`}
      />
      <div ref={modalRef} className={`${className} z-[1000]`}>
        {/* <button onClick={onClose}>Close</button> */}
        {children}
      </div>
    </>
  );
}
