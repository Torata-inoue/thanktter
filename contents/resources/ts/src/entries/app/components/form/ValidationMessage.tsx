import React from "react";
import {useFormContext} from "react-hook-form";
import {Alert} from "@mui/material";

type ValidationMessageProps<T> = { name: keyof T; }
export const ValidationMessage = <T extends object>({ name }: ValidationMessageProps<T>) => {
  const {getFieldState, formState} = useFormContext();
  const {error} = getFieldState(name as string, formState);

  return error ? <Alert severity="error">{error.message}</Alert> : null;
}
