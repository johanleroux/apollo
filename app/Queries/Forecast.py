import pandas
from matplotlib import pyplot
from statsmodels.tsa.arima_model import ARIMA
from pandas.tools.plotting import autocorrelation_plot
import os

os.chdir(os.path.dirname(os.path.realpath(__file__)))

series = pandas.read_csv('data/input.csv',header=0,parse_dates=[0])
series.columns = ['Title','Value']
series.set_index(['Title'],inplace=True)

model = ARIMA(series['Value'].astype(float), order=(2,0,1))

NewModel = model.fit(disp=0,method='css')

StepsAheadToForecast = 10 
ForecastDataArray = NewModel.forecast(steps=StepsAheadToForecast)

SplitPoint = len(series)

for i in range(StepsAheadToForecast):
    series.loc[len(series)] = ForecastDataArray[0][i]

series2 = series[SplitPoint:]

#autocorrelation_plot(series)
#series.plot()

#pyplot.show()

series2.to_csv('data/output.csv')