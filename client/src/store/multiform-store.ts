import { create } from "zustand";
import { Patient, PatientFormDataError } from "../schemas/patient-interfaces";
import { ReactElement } from "react";

import * as z from "zod";

interface MultiformStore {
  data: Patient;
  steps: ReactElement[];
  schemas: z.ZodType<any, any, any>[];
  currentStep?: ReactElement;
  currentIndex: number;
  currentSchema?: z.ZodType<any, any, any>;
  errors: PatientFormDataError;

  setData: (newData: any) => void;
  initialize: ({
    steps,
    schemas,
  }: {
    steps: ReactElement[];
    schemas: z.ZodType<any, any, any>[];
  }) => void;
  next: () => void;
  prev: () => void;
  isLastStep: () => boolean;
  isFirstStep: () => boolean;
  setErrors: (error: object) => void;

  resetFormData: () => void;
}

export const initialPatientFormData: Patient = {
  firstName: "",
  middleName: "",
  lastName: "",
  gender: "other",
  email: "",
  birthDate: "",
  address: "",
  phoneNumber: "",
  emergencyContact: "",
  insuranceProvider: "",
  policyNumber: "",
  password: "",
  photo: "",
};

const useMultiFormStore = create<MultiformStore>((set, get) => ({
  data: initialPatientFormData,
  steps: [],
  schemas: [],
  currentStep: undefined,
  currentIndex: 0,
  currentSchema: undefined,
  errors: {},

  setData: (newData) =>
    set((state) => ({ data: { ...state.data, ...newData } })),

  initialize: ({
    steps,
    schemas,
  }: {
    steps: ReactElement[];
    schemas: z.ZodType<any, any, any>[];
  }) =>
    set((state) => {
      return {
        steps: steps,
        schemas: schemas,
        currentSchema: schemas[state.currentIndex],
        currentStep: steps[state.currentIndex],
      };
    }),

  next: () =>
    set((state) => {
      const nextIndex = state.currentIndex + 1;
      return {
        currentIndex: nextIndex,
        currentSchema: state.schemas[nextIndex],
        currentStep: state.steps[nextIndex],
      };
    }),

  prev: () =>
    set((state) => {
      const prevIndex = state.currentIndex - 1;
      return {
        currentIndex: prevIndex,
        currentSchema: state.schemas[prevIndex],
        currentStep: state.steps[prevIndex],
      };
    }),

  isFirstStep: () => {
    const { currentIndex } = get();
    return currentIndex === 0;
  },

  isLastStep: () => {
    const { currentIndex, steps } = get();
    return currentIndex === steps.length - 1;
  },

  setErrors: (error: object) =>
    set(() => {
      return {
        errors: { ...error },
      };
    }),

  resetFormData: () =>
    set((_) => ({
      data: initialPatientFormData,
    })),
}));

export default useMultiFormStore;
