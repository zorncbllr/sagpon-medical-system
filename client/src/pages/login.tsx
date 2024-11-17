import { LoginForm } from "../components/login-form";
import Logo from "../assets/logo";

function Login() {
  return (
    <main className="w-full h-screen flex bg-primary-foreground">
      <section className="w-full grid place-items-center">
        <div className="w-4/5 h-4/5 bg-green-500 rounded-lg"></div>
      </section>

      <section className="w-1/2 h-full bg-white flex flex-col gap-6 items-center justify-center px-8">
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
