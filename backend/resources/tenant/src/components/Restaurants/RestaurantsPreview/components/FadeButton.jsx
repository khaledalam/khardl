import React, { useState, useEffect } from "react";
import { TbCircleArrowDown } from "react-icons/tb";
import { useSelector } from "react-redux";

const FadeButton = () => {
  const [opacity, setOpacity] = useState(1);
  const price_background_color = useSelector((state) => state.restuarantEditorStyle.price_background_color);

  useEffect(() => {
    const scrollableDiv = document.getElementById("scrollableDiv");

    const handleScroll = () => {
      const maxDocumentHeight =
        scrollableDiv.scrollHeight - scrollableDiv.clientHeight;
      const currentScroll = scrollableDiv.scrollTop;
      const newOpacity = 1 - currentScroll / maxDocumentHeight;
      setOpacity(newOpacity);
    };

    scrollableDiv.addEventListener("scroll", handleScroll);

    return () => {
      scrollableDiv.removeEventListener("scroll", handleScroll);
    };
  }, []);

  return (
    <div
      className="sticky -bottom-1 rounded-xl mx-auto w-fit animate-wiggle"
      style={{
        opacity: opacity,
        color: price_background_color + "80",
      }}
    >
      <TbCircleArrowDown className="rounded-xl w-10 h-10" />
    </div>
  );
};

export default FadeButton;
