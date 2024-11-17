import { LoginForm } from "../components/login-form";
import Logo from "../assets/logo";
import GridPattern from "../components/ui/grid-pattern";

function Login() {
  return (
    <main className="w-full h-screen flex">
      <section className="w-full grid place-items-center">
        <div className="bg-backdrop w-4/5 h-4/5 bg-cover z-50 rounded-lg shadow-xl"></div>
        <GridPattern />
      </section>

      <section className="w-[50rem] h-full bg-white flex flex-col gap-6 items-center justify-center px-8 z-50 shadow-xl">
        <div className="grid place-items-center gap-4">
          <Logo />
          <h1 className="text-4xl font-semibold">Sagpon Health Station</h1>
          <p className="text-center text-slate-500 before:content-[''] before:h-[0.1px] before:bg-slate-300 before:block before:m-4 after:content-[''] after:h-[0.1px] after:bg-slate-300 after:block after:m-4">
            Providing compassionate care and innovative solutions for a
            healthier community.
          </p>
        </div>
        <LoginForm />
      </section>
    </main>
  );
}

export default Login;
