PHP_ARG_ENABLE([sysvsem],
  [whether to enable System V semaphore support],
  [AS_HELP_STRING([--enable-sysvsem],
    [Enable System V semaphore support])])

if test "$PHP_SYSVSEM" != "no"; then
  PHP_NEW_EXTENSION([sysvsem], [sysvsem.c], [$ext_shared])
  AC_DEFINE([HAVE_SYSVSEM], [1],
    [Define to 1 if the PHP extension 'sysvsem' is available.])
  AC_CHECK_TYPES([union semun],,, [
    #include <sys/types.h>
    #include <sys/ipc.h>
    #include <sys/sem.h>
  ])
fi
