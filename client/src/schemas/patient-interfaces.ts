import * as z from "zod";

export const firstStepSchema = z.object({
  firstName: z.string().nonempty("First name is required"),
  middleName: z.string().nonempty("Middle name is required"),
  lastName: z.string().nonempty("Last name is required"),
  address: z.string().nonempty("Address is required"),
});

export const secondStepSchema = z.object({
  birthDate: z.string().nonempty("Birth date is required"),
  phoneNumber: z
    .string()
    .nonempty("Phone number is required")
    .length(11, "Invalid phone number"),
  emergencyContact: z.string().optional(),
  insuranceProvider: z.string().optional(),
  policyNumber: z.string().optional(),
});

export const lastStepSchema = z
  .object({
    email: z
      .string()
      .nonempty("Email is required")
      .email("Invalid email address"),
    password: z
      .string()
      .nonempty("Password is required")
      .min(8, "Password must be at least 8 characters long"),
    confirmPassword: z
      .string()
      .nonempty("Password confirmation is required")
      .min(8, "Confirm password must be at least 8 characters long"),
  })
  .refine((data) => data.password === data.confirmPassword, {
    message: "Passwords don't match",
    path: ["confirmPassword"],
  });

export type BasicPatientInfo = z.infer<typeof firstStepSchema>;
export type AdditionalPatientInfo = z.infer<typeof secondStepSchema>;
export type LastPatientInfo = z.infer<typeof lastStepSchema>;

export interface PatientFormData {
  firstName: string;
  middleName: string;
  lastName: string;
  gender: "male" | "female" | "other";
  email: string;
  birthDate: string;
  address: string;
  phoneNumber: number;
  emergencyContact: number;
  insuranceProvider: string;
  policyNumber: number;
  password: string;
  confirmPassword: string;
}

export interface PatientFormDataError {
  firstName?: { message: string };
  middleName?: { message: string };
  lastName?: { message: string };
  gender?: { message: string };
  email?: { message: string };
  birthDate?: { message: string };
  address?: { message: string };
  phoneNumber?: { message: string };
  emergencyContact?: { message: string };
  insuranceProvider?: { message: string };
  policyNumber?: { message: string };
  password?: { message: string };
  confirmPassword?: { message: string };
}

export interface PatientError {
  message: string;
  errors: {
    firstName?: string[];
    middleName?: string[];
    lastName?: string[];
    gender?: string[];
    email?: string[];
    birthDate?: string[];
    address?: string[];
    phoneNumber?: string[];
    emergencyContact?: string[];
    insuranceProvider?: string[];
    policyNumber?: string[];
    password?: string[];
    confirmPassword?: string[];
  };
}
