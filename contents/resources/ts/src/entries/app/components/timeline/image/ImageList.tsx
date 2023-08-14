import React, { useState } from 'react';
import { Box, IconButton, ImageList as MuiImageList, ImageListItem as MuiImageListItem, Modal } from '@mui/material';
import { DeleteOutline, HighlightOff } from '@mui/icons-material';

const modalBoxStyle = {
  position: 'absolute' as const,
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
};
type ImageModalProps = {
  open: boolean;
  src: string | undefined;
  handleOnClose: () => void;
};
const ImageModal: React.FC<ImageModalProps> = ({ open, src, handleOnClose }) => (
  <Modal open={open} onClose={handleOnClose}>
    <Box sx={modalBoxStyle}>
      <img src={src} alt="image modal" style={{ minWidth: 300, maxWidth: 700 }} />
      <IconButton sx={{ position: 'absolute', top: 2, right: 2, zIndex: 1 }} size="medium" onClick={handleOnClose}>
        <HighlightOff />
      </IconButton>
    </Box>
  </Modal>
);

type CalcImageHeightType = (length: number) => number;
const calcImageHeight: CalcImageHeightType = (length) => {
  const imageHeight = 125;
  if (length > 2) {
    return imageHeight * 2;
  }
  return imageHeight;
};

type ImageListProps = { imageFiles: File[] | string[]; removeImage?: (index: number) => void };
export const ImageList: React.FC<ImageListProps> = ({ imageFiles, removeImage }) => {
  const [open, setOpen] = useState<boolean>(false);
  const [src, setSrc] = useState<string | undefined>(undefined);

  if (imageFiles.length === 0) {
    return null;
  }

  const handleOnClick: (imageUrl: string) => React.MouseEventHandler<HTMLLIElement> = (imageUrl) => () => {
    setOpen(true);
    setSrc(imageUrl);
  };

  const handleOnRemove: (index: number) => React.MouseEventHandler<HTMLButtonElement> = (index) => (event) => {
    event.stopPropagation();
    if (removeImage) {
      removeImage(index);
    }
  };

  const handleOnClose: () => void = () => {
    setOpen(false);
  };

  return (
    <>
      <MuiImageList
        sx={{ width: 300, height: calcImageHeight(imageFiles.length), marginX: 'auto' }}
        cols={2}
        rowHeight={125}
      >
        {imageFiles.map((image, index) => {
          const imageUrl = image instanceof File ? URL.createObjectURL(image) : image;
          return (
            <MuiImageListItem key={imageUrl} onClick={handleOnClick(imageUrl)}>
              <img src={imageUrl} alt={`image-${index}`} loading="lazy" style={{ objectFit: 'cover' }} />
              {removeImage && (
                <IconButton
                  sx={{ position: 'absolute', top: 2, right: 2, zIndex: 1 }}
                  size="small"
                  onClick={handleOnRemove(index)}
                >
                  <DeleteOutline />
                </IconButton>
              )}
            </MuiImageListItem>
          );
        })}
      </MuiImageList>
      <ImageModal open={open} src={src} handleOnClose={handleOnClose} />
    </>
  );
};
