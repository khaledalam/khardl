const SocialMedia = ({ restaurantStyle }) => {
  const {
    socialMediaIcons_alignment,
    social_media_color,
    social_media_background_color,
    social_media_radius,
    selectedSocialIcons,
  } = restaurantStyle;
  return (
    <div
      style={{ backgroundColor: social_media_color }}
      className={`w-full min-h-[70px] px-3  rounded-xl flex ${
        socialMediaIcons_alignment === "center"
          ? "items-center justify-center"
          : socialMediaIcons_alignment === "left"
            ? "items-center justify-start"
            : socialMediaIcons_alignment === "right"
              ? "items-center justify-end"
              : ""
      }
        ${selectedSocialIcons?.length == 0 ? "hidden" : ""}`}
    >
      <div className="flex items-center gap-5">
        {selectedSocialIcons?.map((socialMedia) => (
          <a
            href={socialMedia.link ? socialMedia.link : null}
            key={socialMedia.id}
            className="cursor-pointer"
          >
            <div
              className={`w-[35px] h-[35px] bg-[#F3F3F3] flex justify-center items-center relative shadow-md`}
              style={{
                borderRadius: social_media_radius
                  ? social_media_radius + "%"
                  : "50%",
                backgroundColor: social_media_background_color
                  ? social_media_background_color
                  : "#F3F3F3",
              }}
            >
              <img
                src={socialMedia?.imgUrl}
                alt={"whatsapp"}
                className="w-[20px] h-[20px] object-cover"
              />
            </div>
          </a>
        ))}
      </div>
    </div>
  );
};

export default SocialMedia;
