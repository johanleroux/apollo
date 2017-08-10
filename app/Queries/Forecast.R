list.of.packages <- c("ggplot2", "forecast", "reshape2")
new.packages <- list.of.packages[!(list.of.packages %in% installed.packages()[,"Package"])]
if(length(new.packages)) install.packages(new.packages, repos='http://cran.us.r-project.org', dependencies=TRUE)

library(forecast)
library(ggplot2)
library(reshape2)

getScriptPath <- function(){
    cmd.args <- commandArgs()
    m <- regexpr("(?<=^--file=).+", cmd.args, perl=TRUE)
    script.dir <- dirname(regmatches(cmd.args, m))
    if(length(script.dir) == 0) stop("can't determine script dir: please call the script with Rscript")
    if(length(script.dir) > 1) stop("can't determine script dir: more than one '--file' argument detected")
    return(script.dir)
}

setwd(getScriptPath())

Frame <- read.table("data/input.txt", stringsAsFactors=FALSE, header=TRUE)
Frame$Time <- as.Date(Frame$Time, format= "%Y-%m")
Frame <- ts(Frame$Value, start = 1, end=NROW(Frame), frequency=1)

TheForecast <- arima(Frame, order = c(5,1,0), method="ML")

MyForecast <- plot(forecast(TheForecast,h=10))

write.table(MyForecast,file="data/output.txt",quote=F)
