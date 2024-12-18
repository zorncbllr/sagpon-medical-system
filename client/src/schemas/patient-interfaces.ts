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

export const patientSchema = z.object({
  firstName: z.string().nonempty({
    message: "First name is required",
  }),
  middleName: z.string().nonempty({
    message: "Middle name is required",
  }),
  lastName: z.string().nonempty({
    message: "Last name is required",
  }),
  address: z.string().nonempty({
    message: "Address is required",
  }),
  birthDate: z.string().nonempty({
    message: "Birth date is required",
  }),
  phoneNumber: z
    .string()
    .nonempty({
      message: "Phone number is required",
    })
    .length(11, {
      message: "Phone number must be 11 digits",
    }),
  emergencyContact: z.string().optional(),
  insuranceProvider: z.string().optional(),
  policyNumber: z.string().optional(),
  email: z
    .string()
    .nonempty({
      message: "Email is required",
    })
    .email({
      message: "Invalid email address",
    }),
  photo: z.any().optional(),
});

export type PatientProfileForm = z.infer<typeof patientSchema>;

export type BasicPatientInfo = z.infer<typeof firstStepSchema>;
export type AdditionalPatientInfo = z.infer<typeof secondStepSchema>;
export type LastPatientInfo = z.infer<typeof lastStepSchema>;

export interface Patient {
  firstName: string;
  middleName: string;
  lastName: string;
  gender: "male" | "female" | "other";
  email: string;
  birthDate: string;
  address: string;
  phoneNumber: string;
  emergencyContact: string;
  insuranceProvider: string;
  policyNumber: string;
  photo?: string;
  patientId?: string;
  userId?: string;
  password: string;
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

export interface Patients {
  patients: Patient[];
}

export interface PatientMutationResponse {
  message: string;
  patient: Patient;
}
