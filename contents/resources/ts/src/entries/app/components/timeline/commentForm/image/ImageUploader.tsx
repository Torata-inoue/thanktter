import React, { useState } from 'react';
import { ImageListItem as MuiImageListItem, ImageList as MuiImageList } from '@mui/material';
import { useFormContext, useWatch } from 'react-hook-form';
import { TextDiv } from '../../../../../../common/components/Text/TextDiv';
import { CommentFormType } from '../../../../hooks/form/useCommentForm';
import { ValidationMessage } from '../../../form/ValidationMessage';

type CalcImageHeightType = (length: number) => number;
const calcImageHeight: CalcImageHeightType = (length) => {
  const imageHeight = 125;
  if ([3, 4].includes(length)) {
    return imageHeight * 2;
  }
  return imageHeight;
};

type ImageListProps = { imageFiles: File[]; removeImage: (index: number) => void };
const ImageList: React.FC<ImageListProps> = ({ imageFiles, removeImage }) => (
  <MuiImageList sx={{ width: 300, height: calcImageHeight(imageFiles.length) }} cols={2} rowHeight={125}>
    {imageFiles.map((file, index) => (
      <MuiImageListItem key={file.name}>
        <img src={`${URL.createObjectURL(file)}`} alt={file.name} loading="lazy" style={{ objectFit: 'cover' }} />
        <button type="button" onClick={() => removeImage(index)}>
          削除
        </button>
      </MuiImageListItem>
    ))}
  </MuiImageList>
);

type ImageUploaderProps = { children: React.ReactNode };
export const ImageUploader: React.FC<ImageUploaderProps> = ({ children }) => {
  const [drag, setDrag] = useState<boolean>(false);
  const { setValue, getValues, control } = useFormContext<CommentFormType>();

  const imageFiles = useWatch<CommentFormType>({ control, name: 'images' }) as File[];
  const removeImage: (index: number) => void = (index) => {
    const prevValue = getValues('images');
    setValue(
      'images',
      prevValue.filter((_, i) => i !== index)
    );
  };

  const handleOnDragOver: React.DragEventHandler<HTMLDivElement> = (event) => {
    setDrag(true);
    event.preventDefault();
  };

  const handleOnDrop: React.DragEventHandler<HTMLDivElement> = (event) => {
    // TODO バリデーション
    setValue('images', [...event.dataTransfer.files]);
    setDrag(false);
    event.preventDefault();
  };

  const handleOnDragLeave: React.DragEventHandler<HTMLDivElement> = () => {
    setDrag(false);
  };
  return (
    <>
      <div
        onDragOver={handleOnDragOver}
        onDrop={handleOnDrop}
        onDragLeave={handleOnDragLeave}
        style={{ border: drag ? 'solid 3px orange' : 'none' }}
      >
        {children}
      </div>
      <TextDiv textAlign="right">ドラッグ&ドロップで画像を挿入できます</TextDiv>
      <ImageList imageFiles={imageFiles} removeImage={removeImage} />
      <ValidationMessage<CommentFormType> name="images" />
    </>
  );
};
